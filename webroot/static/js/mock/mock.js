// 模拟数据
(function(exports) {
    var moduleCount = 0;
    var modules = [];

    var health = [-1, 0, 1]
    // 模拟一个模块
    function mockModule(level) {
        var moduleName = '模块_' + moduleCount++;
        var module = {
            name: moduleName,
            health: health[Math.round(Math.random() * 2)],
            levelNormalized : level / 6,
            level : level
        }

        if (!modules[level]) {
            modules[level] = [];
        }
        modules[level].push(module);

        return module;
    }

    function mockLink(module) {
        var level = module.level;
        var targetLevel = module.level + (Math.random() < 0.5 ? 1 : 2);
        var targetModules = modules[targetLevel];
        var link = {
            source: module.name,
            target: targetModules[Math.floor(Math.random() * targetModules.length)].name,
            health: module.health
        }
        return link;
    }

    exports.mockModule = mockModule;
    exports.mockLink = mockLink;
    exports.modules = modules;
})(window)
