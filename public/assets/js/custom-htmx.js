document.addEventListener('htmx:afterOnLoad', function (event) {

    let response = event.detail.xhr.response;

    let initiator = event.detail.elt;


    // const initiator = event.target;
    // console.log(event.detail)
    const xhr = event.detail.xhr;
    // console.log(xhr.status)


    if (xhr.status === 500){

        document.getElementById('htmxerrors').innerHTML = response
    }


    if (xhr.status === 200) {

        if (initiator.id === 'createrestaurantbtn') {

            document.getElementById("closerestaurantmodal").click()

        }
    }

});


