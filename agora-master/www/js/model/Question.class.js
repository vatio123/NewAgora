function Question() {
    //Attributes declaration
    this.idquestion;
    this.nickname;
    this.topicname;
    this.input;
    this.date;

    //Methods declaration
    this.construct = function (idquestion, nickname, topicname, input, date) {
        this.setIdquestion(idquestion);
        this.setNickname(nickname);
        this.setTopicname(topicname);
        this.setInput(input);
        this.setDate(date);
    };

    // Getter and setter
    this.setIdquestion = function (idquestion) {
        this.idquestion = idquestion;
    };
    this.setNickname = function (nickname) {
        this.nickname = nickname;
    };
    this.setTopicname = function (topicname) {
        this.topicname = topicname;
    };
    this.setInput = function (input) {
        this.input = input;
    };
    this.setDate = function (date) {
        this.date = date;
    };
    
    this.getIdquestion = function () {
        return this.idquestion;
    };
    this.getNickname = function () {
        return this.nickname;
    };
    this.getTopicname = function () {
        return this.topicname;
    };
    this.getInput = function () {
        return this.input;
    };
    this.getDate = function () {
        return this.date;
    };


    /*this.validate = function ()    {
        var errors = new Array();

        try{
            if (this.getName().length == 0 || this.getName().match(/^[a-zA-Z]+$/) == null){
                errors.push("Name must be informed and contain only letters");
            }
        } catch (e) {
            errors.push("Name must be informed and contain only letters");
        }

        try{
            if (this.getSurname().length == 0){
                errors.push("Surname must be informed and contain only letters");
            }
        } catch (e){
            errors.push("Surname must be informed and contain only letters");
        }
        return errors;
    }

    this.toString = function () {
        var reservationString = "RESERVATION - ID=" + this.getId() + " FIRST NAME=" + this.getName() + " LAST NAME=" + this.getSurname();
        reservationString += " FIRST ADDRESS=" + this.getFirstAddress() + " SECOND ADDRESS=" + this.getSecondAddress() + " CITY=" + this.getCity();
        reservationString += " STATE=" + this.getState() + " POSTAL CODE=" + this.getPostalCode() + " ADULTS=" + this.getNumOfAdults();
        reservationString += " CHILDREN=" + this.getNumOfChildren() + " PHONE=" + this.getPhone() + " EMAIL=" + this.getEmail();
        reservationString += " ROOM PREF=" + this.getRoomPreference() + " CHECK IN DATE=" + this.getCheckInDate() + " CHECK OUT DATE=" + this.getCheckOutDate();
        reservationString += " CHECK IN TIME=" + this.getCheckInTime() + " CHECK OUT TIME=" + this.getCheckOutTime() + " SPECIAL REQ=" + this.getSpecialRequests() + " SPECIAL INS=" + this.getSpecialInstructions();
        return reservationString;
    }*/
} // END Question class
