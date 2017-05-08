function Answer ()
{
	//Attributes declaration
	this.idanswer;
  this.idquestion;
	this.nickname;
	this.topicname;
	this.input;
	this.dateIn;


	//Methods declaration
	this.construct = function (idanswer,idquestion,nickname,topicname, input,dateIn)
	{
		this.setIdanswer(idanswer);
		this.setNickname(nickname);
		this.setTopicname(topicname);
		this.setInput(input);
		this.setDateIn(dateIn);
	}

	this.setIdanswer = function (idanswer){this.idanswer=idanswer;}
	this.setInput = function (input){this.input=input;}
	this.setDateIn = function (dateIn){this.dateIn=dateIn;}
	this.setNickname = function (nickname){this.nickname=nickname;}
	this.setTopicname = function (topicname){this.topicname=topicname;}
  this.setIdquestion = function (idquestion){this.idquestion = idquestion;}

	this.getIdanswer = function () {return this.idanswer;}
	this.getInput = function () {return this.input;}
	this.getDateIn = function () {return this.dateIn;}
	this.getNickname = function () {return this.nickname;}
	this.getTopicname = function () {return this.topicname;}
  this.getIdquestion = function() {return this.idquestion;}


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
		var reviewString ="idanswer="+this.getIdanswer()+" input="+this.getInput()+" dateIn="+this.getDateIn()+" nickname="+this.getNickname();
		reviewString +=" topicname="+this.getTopicname()+" idquestion="+this.getIdquestion();

		return reviewString;
	}
}
