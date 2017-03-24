function Director ()
{
	//Attributes declaration
	this.id;
	this.name;
	this.surname1;
	this.surname2;



	//Methods declaration
	this.construct = function (id,name,surname1,surname2)
	{
		this.setId(id);
		this.setName(name);
		this.setSurname1(surname1);
		this.setSurname2(surname2);
	}

	this.setId = function (id){this.id=id;}
	this.setName = function (name){this.name=name;}
	this.setSurname1 = function (surname1){this.surname1=surname1;}
	this.setSurname2 = function (surname2){this.surname2=surname2;}

	this.getId = function () {return this.id;}
	this.getName = function () {return this.name;}
	this.getSurname1 = function () {return this.surname1;}
	this.getSurname2 = function () {return this.surname2;}

	this.arrayToString = function (arrayReviewObj)
	{
		var reviewString ="";
		$.each(arrayReviewObj, function (index, review){
			reviewString+="reiew number "+(index+1)+":"+review.toString()+"\n";
		});
		return reviewString;
	}

	this.toString = function ()
	{
		var reviewString ="id="+this.getId()+" name="+this.getName()+" surname1="+this.getSurname1();
		reviewString +=" surname2="+this.getSurname2();

		return reviewString;
	}
}
