function Review ()
{
	//Attributes declaration
	this.id;
	this.idFilm;
	this.dateReview;
	this.rate;
	this.description;


	//Methods declaration
	this.construct = function (id,idFilm,dateReview, rate,description)
	{
		this.setId(id);		;
		this.setIdFilm(idFilm);
		this.setDateReview(dateReview);
		this.setRate(rate);
		this.setDescription(description);
	}

	this.setId = function (id){this.id=id;}
	this.setRate = function (rate){this.rate=rate;}
	this.setDescription = function (description){this.description=description;}
	this.setIdFilm = function (idFilm){this.idFilm=idFilm;}
	this.setDateReview = function (dateReview){this.dateReview=dateReview;}

	this.getId = function () {return this.id;}
	this.getRate = function () {return this.rate;}
	this.getDescription = function () {return this.description;}
	this.getIdFilm = function () {return this.idFilm;}
	this.getDateReview = function () {return this.dateReview;}


	this.arrayToString = function (arrayReview)
	{
		var reviewString ="";
		$.each(arrayReview, function (index, review){
			reviewString+="reiew number "+(index+1)+":"+review.toString()+"\n";
		});
		return reviewString;
	}

	this.toString = function ()
	{
		var reviewString ="id="+this.getId()+" rate="+this.getRate()+" description="+this.getDescription()+" idFilm="+this.getIdFilm();
		reviewString +=" dateReview="+this.getDateReview();

		return reviewString;
	}
}
