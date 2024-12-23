

import * as fal from "@fal-ai/serverless-client";



async function flexCall(prompt,width,height) {
    try {

        console.log(width,height)
        const result = await fal.subscribe("fal-ai/flux/schnell", {
            input: {
                prompt: prompt,
                image_size:{
                    width:width,
                    height:height
                }
            },
            logs: true,
            onQueueUpdate: (update) => {
                if (update.status === "IN_PROGRESS") {
                    update.logs.map((log) => log.message).forEach(console.log);
                }
            },
        });





        //
        //   // Prepare data to be sent as JSON
        //   const formData = {
        //       url: result['images'][0]['url'],
        //   };
        //
        // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        //
        //   // Make the POST request using fetch
        //   fetch('/flux-schnell/save', {
        //       method: 'POST',
        //       headers: {
        //           'Content-Type': 'application/json', // Indicate that we are sending JSON
        //           'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
        //       },
        //       body: JSON.stringify(formData) // Convert JS object to JSON string
        //   })
        //       .then(response => {
        //           if (!response.ok) {
        //               // Handle HTTP errors
        //               throw new Error('Network response was not ok ' + response.statusText);
        //           }
        //           return response.json(); // Parse JSON response
        //       })
        //       .then(data => {
        //           console.log('Success:', data);
        //       })
        //       .catch(error => {
        //           console.error('Error:', error);
        //       });



// ================== Traditional form submission  ========================


// Create a form element
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/flux-schnell/save';

// Include the CSRF token as a hidden input
        const csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = 'hidden';
        csrfTokenInput.name = '_token'; // The default CSRF token name in Laravel
        csrfTokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrfTokenInput);

// Add the form data as hidden inputs
        const urlInput = document.createElement('input');
        urlInput.type = 'hidden';
        urlInput.name = 'url'; // Make sure this matches the form data expected on the server side
        urlInput.value = result['images'][0]['url'];
        form.appendChild(urlInput);

        const userprompt= document.createElement('input');
        userprompt.type = 'hidden';
        userprompt.name = 'prompt'; // Make sure this matches the form data expected on the server side
        userprompt.value = prompt;
        form.appendChild(userprompt);


// Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();

    } catch (error) {
        console.log(error);
    }
}

async function runwayCall() {
    try {

        // https://queue.fal.run/fal-ai/runway-gen3/turbo/image-to-video
        const { request_id } = await fal.queue.submit("fal-ai/runway-gen3/turbo/image-to-video", {
            input: {
                prompt: "A bunny eating a carrot in the field.",
                image_url: "https://images.pexels.com/photos/248547/pexels-photo-248547.jpeg"
            },
            // webhookUrl: "https://optional.webhook.url/for/results",
        });

        console.log(request_id)


// ================== Traditional form submission  ========================

//
// // Create a form element
//         const form = document.createElement('form');
//         form.method = 'POST';
//         form.action = '/flux-schnell/save';
//
// // Include the CSRF token as a hidden input
//         const csrfTokenInput = document.createElement('input');
//         csrfTokenInput.type = 'hidden';
//         csrfTokenInput.name = '_token'; // The default CSRF token name in Laravel
//         csrfTokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
//         form.appendChild(csrfTokenInput);
//
// // Add the form data as hidden inputs
//         const urlInput = document.createElement('input');
//         urlInput.type = 'hidden';
//         urlInput.name = 'url'; // Make sure this matches the form data expected on the server side
//         urlInput.value = result['images'][0]['url'];
//         form.appendChild(urlInput);
//
//         const userprompt= document.createElement('input');
//         userprompt.type = 'hidden';
//         userprompt.name = 'prompt'; // Make sure this matches the form data expected on the server side
//         userprompt.value = prompt;
//         form.appendChild(userprompt);
//
//
// // Append the form to the body and submit it
//         document.body.appendChild(form);
//         form.submit();

    } catch (error) {
        console.log(error);
    }
}


// Attach it to the window object so it can be used globally

window.flexCall = flexCall;
window.runwayCall = runwayCall;
window.fal = fal;

