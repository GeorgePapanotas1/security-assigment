

function createLocal(needle, value){
    localStorage.setItem(needle, JSON.stringify(value));
}

function getLocal(needle){
    return localStorage.getItem(needle)
}

async function request(
    method,
    url,
    body = {},
    headers = {'Content-Type':'application/json', 'Accept': 'application/json'}
){
    if(method === 'POST') {
        return response = await fetch(url, {
            method: method,
            headers: headers,
            body: JSON.stringify(body)
        })
    }else {
        return response = await fetch(url, {
            method: method,
            headers: headers
        })
    }

}


async function isAuthenticated(url){
    token = getLocal('local-auth-tk').slice(1, -1);
    token_xp = getLocal('local-auth-xp');

    if(!token) {
        alert('redirect to login')
        exp = new Date(token_xp);
        if(exp < new Date().getTime()) {
            alert('expired, redirect to login')
        }
    }

    var myHeaders = new Headers();
    myHeaders.append("Authorization", "Bearer " + token);
    myHeaders.append("Accept", "application/json");
    // myHeaders.append("Cookie", "XSRF-TOKEN=eyJpdiI6ImdtLzRFRnVVcklDallPV2d1NHdYc0E9PSIsInZhbHVlIjoiL2VCRmNYd2tHR21WbnBjYkMwZ3UxSUZEVXBsUllHUXVQVUZxM2thS1lvT0NBYUdyTS9WajBJUGF0YjZ1bTN6aHJUK2VPMm1CTkpuRnBkY0pmR1VzMDJiNTMyUU9hL2hNdlcwZ2ZGM2JUdmdYR1lxemhFcFl0SmR1RHRZUHFiaWQiLCJtYWMiOiJmNTM5ZTA0NGJjYTRmOGFjNzg5YjM5Y2YyYmFjMjExZmU2NDk4Y2MxNjYzOGEzNjIzOGE3NDM0N2RjMDM0YzNjIiwidGFnIjoiIn0%3D; security_session=eyJpdiI6ImU4UTJzWnZpc2dValNaWkhiUlNJY2c9PSIsInZhbHVlIjoiU004YnhFckVGd29DbElKbi9rVmZhY0hweTZuVmV3ZGhuS2JzWTRYeWxscnBGSDRIS3lOR1lCcmdXblFEeHNXZERlc014a2hFRFVieHo2cWpreDFPeUxGL3lVUnFldTA3K0RDK0RMMHRUNnJadE4vMW84WENIemo2eEg0MjVOaUciLCJtYWMiOiIwMzQ2YmY1OWIzY2Q2NzYzYjkzMTYyNjIxNTM1YzlmYjVmZDI1Y2FmY2VjYTg0ZjlhMWEwOWI3MWI5MjA5ZGRlIiwidGFnIjoiIn0%3D");

    return response = await request(
        'GET',
        url,
        myHeaders
    )
}

async function isAuthenticated(url, return_uri){

    token = getLocal('local-auth-tk');
    token_xp = getLocal('local-auth-xp');

    if(!token) {

        window.location.href = '/auth/login?ret='+return_uri
        return 0;
    }

    exp = new Date(token_xp);
    if(exp < new Date().getTime()) {
        window.location.href = '/auth/login?ret='+return_uri
    }

    token = token.slice(1, -1)

    var myHeaders = new Headers();
    myHeaders.append("Authorization", "Bearer " + token);
    myHeaders.append("Accept", "application/json");

    var requestOptions = {
        method: 'GET',
        headers: myHeaders,
        redirect: 'follow'
    };

    return await fetch(url, requestOptions)
}

async function logout(url){
    token = getLocal('local-auth-tk');
    token = token.slice(1, -1)

    var myHeaders = new Headers();
    myHeaders.append("Authorization", "Bearer " + token);
    myHeaders.append("Accept", "application/json");

    var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        redirect: 'follow'
    };

    return await fetch(url, requestOptions)
}
