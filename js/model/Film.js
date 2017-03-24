/* @name:
 * @author:
 * @date:
 * @description:
 * @Attributes:
 * 		id: identification of food in stock
 * 		.
 * 		.
 *		.
 * @methods:
 * 		construct
 * 		set's and get's foor each attribute
 *
 *
 *
*/
function Film ()
{
	//Attributes declaration
	this.id;
	this.idFilmType;
	this.idDirector;
	this.name;
	this.price;
	this.image;
	this.inSale;
	this.rented;
	this.reviews = new Array();


	//Methods declaration
	this.construct = function (id,idFilmType,idDirector,name,price,image,inSale,rented, reviews)
	{
		this.setId(id);
		this.setIdFilmType(idFilmType);
		this.setName(name);
		this.setIdDirector(idDirector);
		this.setPrice(price);
		this.setImage(image);
		this.setInSale(inSale);
		this.setRented(rented);
		this.setReviews(reviews);
	}

	this.setId = function (id){this.id=id;}
	this.setIdFilmType = function (idFilmType){this.idFilmType=idFilmType;}
	this.setName = function (name){this.name=name;}
	this.setIdDirector = function (idDirector){this.idDirector=idDirector;}
	this.setPrice = function (price){this.price=price;}
	this.setImage = function (image){this.image=image;}
	this.setInSale = function (inSale){this.inSale=inSale;}
	this.setRented = function (rented){this.rented=rented;}
	this.setReviews = function (reviews){this.reviews=reviews;}

	this.getId = function () {return this.id;}
	this.getIdFilmType = function (){return this.idFilmType;}
	this.getName = function () {return this.name;}
	this.getIdDirector = function () {return this.idDirector;}
	this.getPrice = function () {return this.price;}
	this.getImage = function () {return this.image;}
	this.getInSale = function () {return this.inSale;}
	this.getRented = function () {return this.rented;}
	this.getReviews = function () {return this.reviews;}

	this.arrayToString = function (arrayFilm)
	{
		var filmString ="";
		$.each(arrayFilm, function (index, film){
			filmString+="film number "+(index+1)+":"+film.toString()+"\n";
		});
		return filmString;

	}

	this.toString = function ()
	{
		var filmString ="id="+this.getId()+" name="+this.getName()+" idFilmType="+this.getIdFilmType()+" idDirector="+this.getIdDirector();
		filmString +=" price="+this.getPrice()+" image="+this.getImage()+" inSale="+this.getInSale()+" rented="+this.getRented()+" reviews=";

		var review = new reviewObj();
		filmString +=review.arrayToString(this.getReviews());

		return filmString;
	}
}
