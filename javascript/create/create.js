function CreateNewInput(event){
	var input = document.createElement("input");
	input.type = "text";
	input.className = "objects";

	var parent = document.getElementsByClassName("objects");
	console.log(parent.length);
	console.log(parent[parent.length - 1]);
	parent[parent.length - 1].appendChild(input);

	event.preventDefault();
}