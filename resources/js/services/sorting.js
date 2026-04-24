const sort = {
    Sort: (array, columnName) => {
        array.sort(function (a, b) {
            if (a[columnName] < b[columnName]) {
                return -1;
            }
            if (a[columnName] > b[columnName]) {
                return 1;
            }
            return 0;
        });
    }

}

export default sort
