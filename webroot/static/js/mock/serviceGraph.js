(function(exports) {

    'use strict';

    var ServiceGraphNode = function(name, health, url) {
        this.name = name;

        this.label = name;

        this.setHealth(health);

        this.url = url;
    }

    ServiceGraphNode.prototype.setHealth = function(health) {
        this.health = health;
        this.className = health == 1 ? 'healthy' : (health == -1 ? 'sick' : 'normal');
    }

    var ServiceGraphLink = function(sourceNode, targetNode, health, url) {
        this.source = sourceNode;
        this.target = targetNode;

        this.setHealth(health);

        this.url = url;

        this._hashKey = '';
    }

    ServiceGraphLink.prototype.setHealth = function(health) {
        this.health = health;
        this.className = health == 1 ? 'healthy' : (health == -1 ? 'sick' : 'normal');
    }


    /**
     * @global
     * @class ServiceGraph
     * @param {HTMLElement} dom - 需要放置的dom节点
     */
    var ServiceGraph = function(dom) {

        this.tooltip = function() {};

        this.gap = 100;

        this._dom = dom;

        this._nodesMap = {};

        this._linksMap = {};

        this._nodesList = [];

        this._linksList = [];

        this._init();

        this._scale = 1;
        this._originScale = 1;

        this._translate = [0, 0];
        this._originTranslate = [0, 0];
    }
    /**
     * @global
     */
    ServiceGraph.prototype = {

        constructor: ServiceGraph,

        _init: function() {
            var self = this;

            var svgRoot = d3.select(this._dom)
                            .append('svg')
                            .attr('width', this._dom.clientWidth)
                            .attr('height', this._dom.clientHeight);

            var root = svgRoot.append('g');
            this._root = root;

            this._layout = dagreD3.layout().rankSep(this.gap);
            this._renderer = new dagreD3.Renderer();

            this._tooltipDom = document.createElement('div');
            this._tooltipDom.classList.add('graph-tooltip');

            document.body.appendChild(this._tooltipDom);

            // Dragging
            svgRoot.call(d3.behavior.zoom().on("zoom", function() {
                var ev = d3.event;
                self._scale = self._originScale * ev.scale;
                self._translate[0] = ev.translate[0] + self._originTranslate[0];
                self._translate[1] = ev.translate[1] + self._originTranslate[1];

                self._updateTransform();
            }));

            var oldDrawNodes = this._renderer.drawNodes();
            this._renderer.drawNodes(function(graph, root) {
                var svgNodes = oldDrawNodes(graph, root);
                svgNodes.attr('id', function(u) {
                    return 'node-' + u;
                });
                svgNodes.attr('class', function(u) {
                    return 'node enter ' + graph.node(u).className;
                })
                svgNodes.on('click', function(u) {
                    var node = graph.node(u);
                    if (node.url) {
                        window.open(node.url);
                    }
                });
                var mouseoutTimeout;
                svgNodes.on('mouseover', function(u) {
                    if (mouseoutTimeout) {
                        clearTimeout(mouseoutTimeout);
                    }
                    var html = self.tooltip(u);

                    self._tooltipDom.innerHTML = html;
                    self._tooltipDom.style.display = "block";

                    var pos = d3.mouse(document.body);
                    self._tooltipDom.style.left = pos[0] + 'px';
                    self._tooltipDom.style.top = pos[1] + 'px';
                });
                svgNodes.on('mouseout', function(u) {
                    if (mouseoutTimeout) {
                        clearTimeout(mouseoutTimeout);
                    }
                    mouseoutTimeout = setTimeout(function() {
                        self._tooltipDom.style.display = 'none';
                    }, 100);
                });
                return svgNodes;
            });

            var oldDrawEdges = this._renderer.drawEdgePaths();
            this._renderer.drawEdgePaths(function(graph, root) {
                var svgEdges = oldDrawEdges(graph, root);
                svgEdges.attr('class', function(e) {
                    return 'edgePath enter ' + graph.edge(e).className;
                });
                svgEdges.on('click', function(e) {
                    var edge = graph.edge(e);
                    if (edge.url) {
                        window.open(edge.url);
                    }
                });
                return svgEdges;
            });

        },

        /**
         * 在力导向图中添加一个模块（节点）
         * @param {string} name - 模块名称
         * @param {number} health - 绿色（1）、黄色（0）、红色（-1）
         * @param {string} url - 链接
         * @return {ServiceGraphNode}
         */
        addModule: function(name, health, url) {
            if (!this._nodesMap[name]) {
                var node = new ServiceGraphNode(name, health, url || '');

                this._nodesMap[name] = node;
                this._nodesList.push(node);

                return node;
            }
        },

        /**
         * 在力导向中移除一个模块
         * @param  {string} name - 模块名称
         */
        removeModule: function(name) {
            var node = this._nodesMap[name];
            if (node) {
                delete this._nodesMap[name];

                //remove the links
                var len = this._linksList.length;
                for (var i = 0; i < len;) {
                    var link = this._linksList[i];
                    if (link.source == node || link.target == node) {
                        len--;
                        delete this._linksMap[name];
                        this._linksList.splice(i, 1);
                    } else {
                        i++
                    }
                }
            }
        },

        /**
         * 更新模块的健康值
         * @param {string} name - 模块名
         * @param {number} health - 绿色（1）、黄色（0）、红色（-1）
         */
        setModuleHealth: function(name, health) {
            var node = this._nodesMap[name];

            node.setHealth(health);
            
            d3.select("#node-" + name).attr('class', 'node enter ' + node.className);
        },

        /**
         * 添加一条边表示模块之间的关系
         * @param {string} source - 源节点名称
         * @param {string} target - 目标节点名称
         * @param {number} health - 绿色（1）、黄色（0）、红色（-1）
         * @param {string} url - 链接
         * @return {ServiceGraphLink}
         */
        addLink: function(source, target, health, url) {
            var name = this._hashLink(source, target);

            if (!this._linksMap[name]) {
                var sourceNode = this._nodesMap[source];
                var targetNode = this._nodesMap[target];

                var link = new ServiceGraphLink(sourceNode, targetNode, health, url);

                link._hashKey = name;
                this._linksMap[name] = link;
                this._linksList.push(link);
                
                return link;
            }
        },

        /**
         * 移除模块之间的关系
         * @param  {string} source - 源节点名称
         * @param  {string} target - 目标节点名称
         */
        removeLink: function(source, target) {
            var name, link;
            if (source instanceof ServiceGraphLink) {
                link = source;
                name = link._hashKey;
            } else {
                name = this._hashLink(source, target);
                link = this._linksMap[name];
            }
            delete this._linksMap[name];
            this._linksList.splice(this._linksList.indexOf(link), 1);
        },

        /**
         * 设置图的缩放
         * @param {number}
         */
        setScale: function(s) {
            this._scale = this._originScale = s;
            this._updateTransform();
        },

        setTranslate: function(x, y) {
            this._originTranslate[0] = this._translate[0] = x;
            this._originTranslate[1] = this._translate[1] = y;
            this._updateTransform();
        },

        _updateTransform: function() {
            this._root.attr("transform", "translate(" + this._translate + ") scale(" + this._scale + ")");
        },

        _hashLink: function(source, target) {
            return source + '-' + target;
        },

        _fitToScreen: function() {
            var bbox = this._root[0][0].getBoundingClientRect();
            var sw = this._dom.clientWidth / bbox.width;
            var sh = this._dom.clientHeight / bbox.height;
            var s = Math.min(sw, sh);
            if (s <= 1) {
                this.setScale(s);
                if (sh > 1) {
                    this.setTranslate(0, (this._dom.clientHeight - bbox.height) / 2);
                }
                if (sw > 1) {
                    this.setTranslate((this._dom.clientWidth - bbox.width) / 2, 0);
                }
            } else {
                this.setTranslate(
                    (this._dom.clientWidth - bbox.width) / 2,
                    (this._dom.clientHeight - bbox.height) / 2
                )
            }
        },

        refresh: function() {
            var g = new dagreD3.Digraph();
            for (var i = 0; i < this._nodesList.length; i++) {
                var node = this._nodesList[i];
                g.addNode(node.name, node);
            }
            for (var i = 0; i < this._linksList.length; i++) {
                var link = this._linksList[i];
                g.addEdge(null, link.source.name, link.target.name, link);
            }

            this._renderer.layout(this._layout).run(g, this._root);

            this._fitToScreen();
        },

        _handleModuleClick: function(obj) {

        }
    }

    exports.ServiceGraph = ServiceGraph;

})(window)  