
function divideBy2(decNumber){
	var remStack = new Stack(),
	rem,
	binaryString='';

	while(decNumber > 0){
		rem = Math.floor(decNumber % 2); 
		console.log("rem = " + rem);
		remStack.push(rem);
		
		decNumber = Math.floor(decNumber/2);
		console.log("decNumber is: "+decNumber.toString());
	}

	while(!remStack.isEmpty()){
		binaryString += remStack.pop().toString();
	}

	return binaryString;
}