export default() => {

    let params = {
            headers : {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }


    let token;
    if (token = localStorage.getItem('access_token')) {
        params.headers.Authorization = 'Bearer ' + token
    }

    return axios.create(params)
}
