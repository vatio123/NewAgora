function Reporta() {
    //Attributes declaration
    this.idreporta;
    this.nickname;
    this.idanswer;
    this.reporttext;
    this.date;

    //Methods declaration
    this.construct = function (idreporta, nickname, idanswer, reporttext, date){
        this.setIdreporta(idreporta);
        this.setNickname(nickname);
        this.setIdanswer(idanswer);
        this.setReporttext(reporttext);
        this.setDate(date);
    };

    // Getter and setter
    this.setIdreporta = function (idreporta) {
        this.idreporta = idreporta;
    };
    this.setNickname = function (nickname) {
        this.nickname = nickname;
    };
    this.setIdanswer = function (idanswer) {
        this.idanswer = idanswer;
    };
    this.setReporttext = function (reporttext) {
        this.reporttext = reporttext;
    };
    this.setDate = function (date) {
        this.date = date;
    };

    this.getIdreporta = function () {
        return this.idreporta;
    };
    this.getNickname = function () {
        return this.nickname;
    };
    this.getIdanswer = function () {
        return this.idanswer;
    };
    this.getReporttext = function () {
        return this.reporttext;
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
