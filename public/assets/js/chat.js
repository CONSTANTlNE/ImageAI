import SimpleBar from 'simplebar'; // Import SimpleBar
import 'simplebar/dist/simplebar.css'; // Import SimpleBar CSS


document.addEventListener('DOMContentLoaded', () => {


    (function () {
        "use strict";

        var myElement1 = document.getElementById('chat-msg-scroll');
        if (myElement1) {
            new SimpleBar(myElement1, {autoHide: true});
        }
//         var myElement2 = document.getElementById('groups-tab-pane');
//         if (myElement2) {
//         new SimpleBar(myElement2, {autoHide: false});
// }
        var myElement3 = document.getElementById('calls-tab-pane');
        if (myElement3) {
            new SimpleBar(myElement3, {autoHide: true});
        }
        var myElement4 = document.getElementById('main-chat-content');
        if (myElement4) {
            new SimpleBar(myElement4, {autoHide: true});

        }

        var myElement5 = document.getElementById('chat-user-details');
        if (myElement5) {
            new SimpleBar(myElement5, {autoHide: true});
        }

        document.querySelectorAll(".responsive-userinfo-open").forEach((ele) => {
            ele.addEventListener("click", () => {
                document.querySelector("#chat-user-details").classList.add("open")
                console.log('click')
            })
        })

        const responsivechatclose = document.querySelector(".responsive-chat-close");
        if (responsivechatclose) {
            responsivechatclose.addEventListener("click", () => {
                document.querySelector(".main-chart-wrapper").classList.remove("responsive-chat-open")
                console.log('click')
            })
        }
        const responsivechatclose2 = document.querySelectorAll(".responsive-chat-close2");

        if (responsivechatclose2) {
            responsivechatclose2.forEach((ele) => {
                ele.addEventListener("click", () => {
                    document.querySelector("#chat-user-details").classList.remove("open")
                })
            })
        }

        const chatinfo = document.querySelector(".chat-info");
        const chatcontent = document.querySelector(".chat-content");

        if (chatinfo) {
            chatinfo.addEventListener("click", () => {
                document.querySelector("#chat-user-details").classList.remove("open")
            })
        }

        if (chatcontent) {
            chatcontent.addEventListener("click", () => {
                document.querySelector("#chat-user-details").classList.remove("open")
            })
        }

    })();

    let changeTheInfo = (element, name, img, status) => {
        document.querySelectorAll(".checkforactive").forEach((ele) => {
            ele.classList.remove("active")
        })
        element.closest("li").classList.add("active")
        // document.querySelectorAll(".chatnameperson").forEach((ele) => {
        //     ele.innerText = name
        // })
        // let image = `../assets/images/faces/${img}.jpg`
        // document.querySelectorAll(".chatimageperson").forEach((ele) => {
        //     ele.src = image
        // })
        //
        // document.querySelectorAll(".chatstatusperson").forEach((ele) => {
        //     ele.classList.remove("online")
        //     ele.classList.remove("offline")
        //     ele.classList.add(status)
        // })


        document.querySelector(".chatpersonstatus").innerText = status

        document.querySelector(".main-chart-wrapper").classList.add("responsive-chat-open")
    }


    // SIMPLEBAR scroll to bottom
    const chatscroll = document.querySelector('.custom-chat-content');
    if (chatscroll) {
        const chatsimplebar = new SimpleBar(chatscroll);

        // Accessing the scroll element directly via SimpleBar’s element property
        const scrollElement = chatscroll.querySelector('.simplebar-content-wrapper');

        if (scrollElement) {
            scrollElement.scrollTop = scrollElement.scrollHeight;
        } else {
            console.error('SimpleBar scrollable content could not be found.');
        }
    }


    const chatinfo = document.getElementById('myTabContent');


    new SimpleBar(chatinfo); // Use the imported SimpleBar directly



})