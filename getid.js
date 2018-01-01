    params = "nazwa=" + nazwa
    request = new ajaxRequest()

    request.open("POST", "/php/table.php", true)
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    request.setRequestHeader("Content-length", params.length)
    request.setRequestHeader("Connection", "close")
    
    request.onreadystatechange = function(){
        if (this.readyState == 4){
            if (this.status == 200){
                if (this.responseText != null){
                    document.getElementById('paragraf').innerHTML = this.responseText
                }
            else alert("Błąd Ajax: nie otrzymano danych")
            }
        else alert("Błąd Ajax: " + this.statusText)
        }
    }
    request.send(params)
    function ajaxRequest(){
    var request = new XMLHttpRequest()
    return request
    }
    function getid(element){
    nazwa = (element.id)
    }