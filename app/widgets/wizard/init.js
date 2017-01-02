console.log("New instance of widget initialized!");
Widget.init({
	func: {
		next : function(){alert(44)}
	
	},
	evt: {
		'input[type=radio]' : {
			change : function(){
				console.log('Selected: ', this.value, 'Load next page...');
			}
		
		}
	
	}

});