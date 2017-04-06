//alert("\/static\/numeric-string.js");
jQuery.extend(jQuery.fn.dataTableExt.oSort,{
	"numeric-string-pre":function(a) {
		return parseInt(a);
	},
	"numeric-string-asc":function(a,b) {
		return ((a<b)?-1:((a>b)?1:0));
	},
	"numeric-string-desc":function(a,b) {
		return ((a<b)?1:((a>b)?-1:0));
	}
});
