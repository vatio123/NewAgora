function Valorationq() {
    //Attributes declaration
    this.idvalorationa;
    this.nickname;
    this.idquestion;
    this.valoration;
    this.date;

    //Methods declaration
    this.construct = function (idvalorationa, nickname, idquestion, valoration, date){
        this.setIdvalorationa(idvalorationa);
        this.setNickname(nickname);
        this.setIdquestion(idquestion);
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
    this.setIdquestion = function (idquestion) {
        this.idquestion = idquestion;
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
    this.getIdquestion = function () {
        return this.idquestion;
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
