import axios from "axios";

//write function definitions here
/**
 * Fetch data from server
 * @param search
 * @param loading
 * @param url
 */
export async function fetchFromServer(search, loading, url) {
    // if (search.length < 2) return;
    loading(true);
    return await axios.get(url, {
        params: {
            search: search,
        }
    })
        .then((r) => {
            loading(false)
            return r.data;
        })
}

export function setData(form, item) {
    for (const obj in item) {
        if (form[obj] !== undefined) {
            form[obj] = item[obj];
        }
    }
}
