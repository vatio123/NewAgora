function Valorationa() {
    //Attributes declaration
    this.idvalorationa;
    this.nickname;
    this.idanswer;
    this.valoration;
    this.date;

    //Methods declaration
    this.construct = function (idvalorationa, nickname, idanswer, valoration, date){
        this.setIdvalorationa(idvalorationa);
        this.setNickname(nickname);
        this.setIdanswer(idanswer);
        this.setValoration(valoration);
        this.setDate(date);
    };

    // Getter and setter
    this.setIdvalorationa = function (idvalorationa) {
        this.idvalorationa = idvalorationa;
    };
    this.setNickname = function (nickname) {
        this.nickname = nickname;
    };
    this.setIdanswer = function (idanswer) {
        this.idanswer = idanswer;
    };
    this.setValoration = function (valoration) {
        this.valoration = valoration;
    };
    this.setDate = function (date) {
        this.date = date;
    };

    this.getIdvalorationa = function () {
        return this.idvalorationa;
    };
    this.getNickname = function () {
        return this.nickname;
    };
    this.getIdanswer = function () {
        return this.idanswer;
    };
    this.getValoration = function () {
        return this.valoration;
    };
    this.getDate = function () {
        return this.date;
    };

    /*this.arrayToString = function (arrayReviewObj)
    {
        var reviewString = "";
        $.each(arrayReviewObj, function (index, review) {
            reviewString += "stock number " + (index + 1) + ":" + review.toString() + "\n";
        });
        return reviewString;

    };

    this.toString = function ()
    {
        var reviewString = "REVIEW - ID=" + this.getId() + " RATE=" + this.getRate() + " OPINION=" + this.getOpinion();
        reviewString += " EMAIL=" + this.getEmail();
        return reviewString;
    };*/
} // END User class
