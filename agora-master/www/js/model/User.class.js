function User() {
    //Attributes declaration
    this.nickname;
    this.userscore;
    this.firstname;
    this.lastname;
    this.email;
    this.password;
    this.postalcode;

    //Methods declaration
    this.construct = function (nickname, userscore, firstname, lastname, email, password, postalcode){
        this.setNickname(nickname);
        this.setUserscore(userscore);
        this.setFirstname(firstname);
        this.setLastname(lastname);
        this.setEmail(email);
        this.setPassword(password);
        this.setPostalcode(postalcode);
    };

    // Getter and setter
    this.setNickname = function (nickname) {
        this.nickname = nickname;
    };
    this.setUserscore = function (userscore) {
        this.userscore = userscore;
    };
    this.setFirstname = function (firstname) {
        this.firstname = firstname;
    };
    this.setLastname = function (lastname) {
        this.lastname = lastname;
    };
    this.setEmail = function (email) {
        this.email = email;
    };
    this.setPassword = function (password) {
        this.password = password;
    };
    this.setPostalcode = function (postalcode) {
        this.postalcode = postalcode;
    };


    this.getNickname = function () {
        return this.nickname;
    };
    this.getUserscore = function () {
        return this.userscore;
    };
    this.getFirstname = function () {
        return this.firstname;
    };
    this.getLastname = function () {
        return this.lastname;
    };
    this.getEmail = function () {
        return this.email;
    };
    this.getPassword = function () {
        return this.password;
    };
    this.getPostalcode = function () {
        return this.postalcode;
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
