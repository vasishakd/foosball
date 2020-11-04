import axios from 'axios';

let axiosSource = null;

const postData = (action, data, callback) => {
    if (axiosSource) {
        axiosSource.cancel();
    }

    const cancelToken = axios.CancelToken;
    axiosSource = cancelToken.source();

    axios.post(action, data, {
        cancelToken: axiosSource.token,
    })
        .then(callback)
        .catch((error) => {
            if (!axios.isCancel(error)) {
                if (!error.response) {
                    alert('Ошибка сети. Проверьте ваше подключение к интернету.');
                    console.error(error);
                } else {
                    alert(error.response.data.message || error.message);
                }
            }
        });
};

export {
    postData,
};
