import axios from "axios";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left',
    duration: 5000, // Adjust duration as needed
    singleton: true, // Prevent duplicate toasts
});
let headers = {};

const apiService = {
    headerContent: {
        'Content-Type': 'application/json; charset=utf-8',
    },
    mediaHeaderContent: {
        "Content-Type": "multipart/form-data",
    },

    /*POST*/
    POST: (url, param, callback) => {
        headers = {
            'Content-Type': 'application/json; charset=utf-8',
        }
        axios.post(url, param, {headers: headers}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            const error_code = parseInt(err.toLocaleString().replace(/\D/g, ""));
            if (error_code === 401) {
            }
            if (error_code === 403) {
            }
        })
    },

    /*POST*/
    POST2: (url, param, callback) => {
        headers = {
            'Content-Type': 'application/json; charset=utf-8',
        }
        axios.post(url, param, {headers: headers}).then((response) => {
            callback(response);
        }).catch(err => {
            callback(err?.response?.data)
        })
    },

    /*GET*/
    GET: (url, callback) => {
        headers = {
            'Content-Type': 'application/json; charset=utf-8',
        }
        axios.get(url, {headers: headers}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            const error_code = parseInt(err.toLocaleString().replace(/\D/g, ""));
            if (error_code === 403) {
            }
            if (error_code === 401) {
            }
        })
    },

    /*GET*/
    GET2: (url, params, callback) => {
        headers = {
            'Content-Type': 'application/json; charset=utf-8',
        }
        axios.get(url, {params: params}, {headers: headers}).then((response) => {
            callback(response.data);
        }).catch(err => {
            callback(err?.response?.data)
        })
    },


    /*DELETE*/
    DELETE: (url, params, callback) => {
        headers = {
            'Content-Type': 'application/json; charset=utf-8',
        }
        axios.delete(url, {params: params}, {headers: headers}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            callback(err.response.data)
        })
    },

    /*PATCH*/
    PATCH: (url, params, callback) => {
        headers = {
            'Content-Type': 'application/json; charset=utf-8',
        }
        axios.patch(url, params, {headers: headers}).then((response) => {
            callback(response.data);
        }).catch(err => {
            callback(err?.response?.data)
        })
    },

    /*UPLOAD*/
    UPLOAD: (url, media, callback) => {
        const MediaHeaders = {
            "Content-Type": "multipart/form-data",
        };
        axios.post(url, media, {headers: MediaHeaders}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            callback(err.response.data)
        })
    },

    /*ERROR HANDLER*/
    ErrorHandler(error) {
        Object.entries(error).forEach(([i, v]) => {
            const inputElement = document.querySelector(`[name="${i}"]`);
            const errorReport = inputElement?.closest('.form-group')?.querySelector('.error-report');
            const isInvalid = inputElement?.closest('.form-control',)?.classList.add('is-invalid-custom');
            const isInvalidText = inputElement?.closest('.form-textarea',)?.classList.add('is-invalid-custom');
            if (errorReport) errorReport.textContent = v;
        });
    },

    /*CLEAR ERROR HANDLER*/
    ClearErrorHandler() {
        const elements = document.querySelectorAll('.error-report');
        const formControls = document.querySelectorAll('.form-control')
        const formTextArea = document.querySelectorAll('.form-textarea')
        formControls.forEach((e) => {
            e.classList.remove('is-invalid-custom')
        });
        /*For form textarea*/
        formTextArea.forEach((e) => {
            e.classList.remove('is-invalid-custom')
        });
        elements.forEach((e) => {
            e.textContent = '';
        });
    },

    toasterError(errorObject) {
        for (const field in errorObject) {
            if (errorObject.hasOwnProperty(field)) {
                const errorMessages = errorObject[field];
                errorMessages.forEach(message => {
                    toaster.error(`${message}`);
                });
            }
        }
    },

}


export default apiService;
