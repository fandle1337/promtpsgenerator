export default class RequestBuilder
{
    constructor(paramList = {DOMAIN, AUTH_ID, REFRESH_ID, member_id})
    {
        this.paramList = paramList;
    }

    async fetch(path, config)
    {
        let params = (new URLSearchParams(this.paramList)).toString()
        return await fetch(process.env.WORK_DIRECTORY + path + "?" + params.toString(), config)
            .then(response => response.json())
            .then(response => {
                if(response.status !== 'success') {
                    throw new Error(response.result)
                }
                return response.result
            })
    }
}
