
$(function () {

    // write tags to mp3 file handling 
    $("#audioDetailForm").submit(function (e) {
        e.preventDefault();

        // DO SOMETHING

        var form = this;

        var formdata = new FormData(form);

        $.ajax({
            url: 'server-side-handler.php',
            data: formdata,
            method: "POST",
            contentType: false,
            processData: false,
        }).done(function (response) {
            var data = JSON.parse(response);
            if (data.status == 0) {
                $("body").load(`${document.location.href}`, function (status, response) {
                    alert(data.msg)
                })
            }else if (data.status == 1) {
                alert(data.msg);
            }
        })

        

    });

    // audio extraction form handling
    $("#audioSplitForm").submit(function (e) {
        e.preventDefault();

        // DO SOMETHING

        var form = this;

        var formdata = new FormData(form);

        $.ajax({
            url: 'server-side-handler.php',
            data: formdata,
            method: "POST",
            contentType: false,
            processData: false,
        }).done(function (response) {
            var data = JSON.parse(response);
           
            alert(data.msg)
              
        })

        

    })

    // audio joining form
    $("#joinAudioForm").submit(function (e) {
        e.preventDefault();

        var numberOfFilesToJoin = this["audioFileToJoin"].files.length;
        var startExtractionFromFieldValueCount = this["startExtractFrom"].value.trim().split(",").length;
        var stopExtractionAtFieldValueCount = this["stopExtractAt"].value.trim().split(",").length;
        

        if (startExtractionFromFieldValueCount != numberOfFilesToJoin || stopExtractionAtFieldValueCount != numberOfFilesToJoin) {
            alert(`number of seconds to start extracting audio file & number of seconds to \
             extract must be equal to number of files selected!`)
        }else if(startExtractionFromFieldValueCount != stopExtractionAtFieldValueCount){
            alert("number of seconds to start extracting audio files must be equal to number of seconds \
            to extract from audio file!");
        }else{
    
            // DO SOMETHING

            var form = this;
            var formdata = new FormData(form);

            $.ajax({
                url: 'server-side-handler.php',
                data: formdata,
                method: "POST",
                contentType: false,
                processData: false,
            }).done(function (response) {
                var data = JSON.parse(response);
               
                alert(data.msg)
                  
            })
            
        }

    })
    
})
