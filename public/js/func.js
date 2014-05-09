
if(typeof Core === "undefined")
	var Core = {};

Core.Func = {
	getDistinctValues : function(arr, key)
	{
		var k2 = key;
		var arr2 = {};
		arr.forEach(function(value, key){
			k = value[k2];
			arr2[k] = k;
		});
		return arr2;
	},

	getDistinctValues2 : function(arr, key)
	{
		var k2 = key;
		var arr2 = {};
		arr.forEach(function(value, key){
			k = value[k2];
			arr2[k] = k;
		});

		var i = 0;
		var arr3 = [];
		for(v in arr2)
		{
			arr3[i++] = v;
		}

		return arr3;
	},
	
	filterElementsByKey : function(arr, keys)
	{
		var arr2 = [];
		
		keys.forEach(function(value1, key1){
			var temp = [];
			arr.forEach(function(value2, key2){
				if(value2[value1.key] === value1.value)
				{
//					console.log(value1.key + ' === ' +value1.value);
					arr2[key2] = value2;
					temp[key2] = value2;
				}
			});
//			console.log(temp);
			arr2 = temp;

		});
		return arr2;
	},
	
	getFirst : function(arr)
	{
		for(v in arr)
		{
			return arr[v];
		}
//		arr.forEach(function(value, key){
//			return {key : value};
//		});
	},
	
	getNextValue : function(arr, value)
	{
		//console.log(arr);
		var searchedValue = value;
		
		var markNext = 0;
		var ret = false;
		arr.forEach(function(value, key){
		//for(value in arr){
			
			//return next value
			if(markNext === 1)
				ret = value;
			
			//console.log('searchedValue: ' +searchedValue);
			//console.log('value: ' + value);
			if(searchedValue === value)
				markNext = 1;
			else
				markNext = 0;
			
			//console.log('markNext: ' + markNext);
		});
		
		//console.log(ret);
		return ret;
	}
};
