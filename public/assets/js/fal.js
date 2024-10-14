

import * as fal from "@fal-ai/serverless-client";

fal.config({
    credentials: "c4fc7928-afcd-4045-a5dc-20fdd82ed030:cc2ca7774e7cca01341794853f85f01e"
});

async function fetchPrompt() {
    const response = await fetch('/flux-dev');
    if (!response.ok) {
        throw new Error('Failed to fetch prompt');
    }
    const data = await response.json();
    return data.prompt;
}


async function callFalAi() {
    try {
        const prompt = await fetchPrompt(); // Get the prompt from the server

        const result = await fal.subscribe("fal-ai/flux/dev", {
            input: {
                prompt: prompt
            },
            logs: true,
            onQueueUpdate: (update) => {
                if (update.status === "IN_PROGRESS") {
                    update.logs.map((log) => log.message).forEach(console.log);
                }
            },
        });

        console.log(result); // Log the result to see the response data
    } catch (error) {
        console.log(error);
    }
}

// Call the function to make the API call

document.getElementById('fetch-prompt').addEventListener('click', () => {
    callFalAi(); // Call the function to fetch and use the prompt
});

