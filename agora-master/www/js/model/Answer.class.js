function Answer ()
{
	//Attributes declaration
	this.idAnswer;
  this.idQuestion;
	this.nick;
	this.topicName;
	this.input;
	this.dateIn;


	//Methods declaration
	this.construct = function (idAnswer,idQuestion,nick,topicName, input,dateIn)
	{
		this.setIdAnswer(idAnswer);
		this.setNick(nick);
		this.setTopicName(topicName);
		this.setInput(input);
		this.setDateIn(dateIn);
	}

	this.setIdAnswer = function (idAnswer){this.idAnswer=idAnswer;}
	this.setInput = function (input){this.input=input;}
	this.setDateIn = function (dateIn){this.dateIn=dateIn;}
	this.setNick = function (nick){this.nick=nick;}
	this.setTopicName = function (topicName){this.topicName=topicName;}
  this.setIdQuestion = function (idQuestion){this.idQuestion = idQuestion;}

	this.getIdAnswer = function () {return this.idAnswer;}
	this.getInput = function () {return this.input;}
	this.getDateIn = function () {return this.dateIn;}
	this.getNick = function () {return this.nick;}
	this.getTopicName = function () {return this.topicName;}
  this.getIdQuestion = function() {return this.idQuestion;}


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
		var reviewString ="idAnswer="+this.getIdAnswer()+" input="+this.getInput()+" dateIn="+this.getDateIn()+" nick="+this.getNick();
		reviewString +=" topicName="+this.getTopicName()+" idQuestion="+this.getIdQuestion();

		return reviewString;
	}
}
