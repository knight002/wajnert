
if(typeof Core === "undefined")
	var Core = {};

Core.Func = {
	getDictinctValues : function(arr, key)
	{
		var k2 = key;
		var arr2 = {};
		arr.forEach(function(value, key){
			k = value[k2];
			arr2[k] = k;
		});
		return arr2;
	},
	
	filterElementsByKey : function(arr, keys)
	{
		var arr2 = {};
		keys.forEach(function(value1, key1){
			arr.forEach(function(value2, key2){
				if(value2[value1.key] === value1.value)
				{
					arr2[key2] = value2;
				}
			});

		});
		return arr2;
	}
};
