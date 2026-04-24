const isURL = {

    isURL(str) {
        const urlRegex = /^(https?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ./?%&=]*)?$/;
        this.url = urlRegex.test(str);
        return this.url;
    }

}

export default isURL
