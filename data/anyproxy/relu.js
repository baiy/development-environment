let rule = {
    "file": [
        {
            "url": "rohr.min.js",
            "path": "rohr.min.js",
        }
        // ,{
        //     "url": "index-2ef256f2d8.js",
        //     "path": "meituan/index-2ef256f2d8.js",
        // }
        // ,{
        //     "url": "ticket/poiComparePoiController.js",
        //     "path": "mfw/poiComparePoiController.js",
        // },
    ],
    "replaceFile": function (path) {
        return require("fs").readFileSync(__dirname + "/" + path, "utf-8");
    }
};

module.exports = {
    beforeSendResponse: function (requestDetail, responseDetail) {
        const newResponse = responseDetail.response;
        for (let i = 0; i < rule.file.length; i++) {
            if (requestDetail.url.indexOf(rule.file[i].url) !== -1) {
                newResponse.body = rule.replaceFile(rule.file[i].path);
            }
        }
        return {
            response: newResponse
        }
    }
};
