fetch('http://localhost:8080/LiquorAPI/liquor/tag/Highball')
    .then(response => response.json())
    .then(data => {
        for(let i = 0; i < data.length; i++){
            let cname = data[i].cname;
            let ename = data[i].ename;
            let photoUrl = data[i].photoUrl;
            console.log(i);
            let content_front = "<div class=\"card\" data-tilt data-tilt-max=\"10\" style=\"background-image: url(\'" + photoUrl + "\')\"> \
            <div class=\"card_content\"> \
                <a class=\"play-button\"> \
                <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\"> \
                    <path d=\"M42.7,42.7L25,50L7.3,42.7L0,25L7.3,7.3L25,0l17.7,7.3L50,25L42.7,42.7z\" class=\"polygon\"></path> \
                    <polygon points=\"27.5,9 27.5,19 30,21 30,41 20,41 20,21 22.5,19 22.5,9\"></polygon> \
                </svg> \
                </a> \
                <div class=\"card_content_Name\"> \
                <h3 class=\"roll-up\">"
            let content_back = "</h3> \
                    <p class=\"text-reveal\"> \
                    <span> \
                        <span>"  + ename + "</span> \
                    </span> \
                    <span> \
                        <span><span>" + ename + "</span></span> \
                    </span> \
                    </p> \
                </div> \
                </div> \
            </div>"
            let cnameText = "";
            for(let j = 0; j < cname.length; j++){
                cnameText += "<span><span>" + cname[j] + "</span><span>" + cname[j] + "</span></span>"
            }
            document.getElementById("all_card").innerHTML += content_front + cnameText + content_back;
        }
        
    })
    .catch((error) => {
        console.log(`Error: ${error}`);
    })
