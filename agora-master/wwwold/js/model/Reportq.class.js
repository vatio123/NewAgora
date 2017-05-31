function Reportq() {
    //Attributes declaration
    this.idreport;
    this.nickname;
    this.idquestion;
    this.reporttext;
    this.date;

    //Methods declaration
    this.construct = function (idreport, nickname, idquestion, reporttext, date){
        this.setIdreport(idreport);
        this.setNickname(nickname);
        this.setIdquestion(idquestion);
        this.setReporttext(reporttext);
        this.setDate(date);
    };

    // Getter and setter
    this.setIdreport = function (idreport) {
        this.idreport = idreport;
    };
    this.setNickname = function (nickname) {
        this.nickname = nickname;
    };
    this.setIdquestion = function (idquestion) {
        this.idquestion = idquestion;
    };
    this.setReporttext = function (reporttext) {
        this.reporttext = reporttext;
    };
    this.setDate = function (date) {
        this.date = date;
    };

    this.getIdreport = function () {
        return this.idreport;
    };
    this.getNickname = function () {
        return this.nickname;
    };
    this.getIdquestion = function () {
        return this.idquestion;
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
