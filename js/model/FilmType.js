function FilmType ()
{
	//Attributes declaration
	this.id;
	this.name;


	//Methods declaration
	this.construct = function (id,name)
	{
		this.setId(id);
		this.setName(name);
	}

	this.setId = function (id){this.id=id;}
	this.setName = function (name){this.name=name;}

	this.getId = function () {return this.id;}
	this.getName = function () {return this.name;}
}
