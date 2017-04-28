function Topic() {
    //Attributes declaration
    this.topicname;
    this.maintopic;

    //Methods declaration
    this.construct = function (topicname, maintopic){
        this.setTopicname(topicname);
        this.setMaintopic(maintopic);
    };

    // Getter and setter
    this.setTopicname = function (topicname) {
        this.topicname = topicname;
    };
    this.setMaintopic = function (maintopic) {
        this.maintopic = maintopic;
    };

    this.getTopicname = function () {
        return this.topicname;
    };
    this.getMaintopic = function () {
        return this.maintopic;
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
