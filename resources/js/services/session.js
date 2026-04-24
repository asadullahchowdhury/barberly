const session = {

    setSession(name, jsonData) {
        sessionStorage.setItem(name, jsonData);
    },

    getSession(name) {
        return sessionStorage.getItem(name)
    }

}

export default session;
