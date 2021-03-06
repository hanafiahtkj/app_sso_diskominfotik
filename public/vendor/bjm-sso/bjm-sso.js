class BjmSSO {

    constructor() {
        this.base_url = 'https://bapintar.banjarmasinkota.go.id';
        // this.base_url = 'http://server.banjarmasinkota.go.id:8000';
        // this.base_url = 'http://127.0.0.1:8000';

        var url_string = window.location.href;
        var url = new URL(url_string);
        var token = url.searchParams.get("token");
        this.token = token;
        console.log(token);
        console.log(url_string);

        this.apiCall = axios.create({
            headers: {
                "Content-type": "application/json",
                "Access-Control-Allow-Origin": "*",
                "Accept": "application/json",
                "Authorization": "Bearer " + this.token,
            },
            withCredentials: true
        });
    }

    loading() {
        window.document.body.insertAdjacentHTML('afterbegin', '<div class="loadingsso">Loading&#8230;</div>');
    }

    async isLogin() {
        var url = (this.token != null) ? '/api/isLogin' : '/sso/is-login';
        const response = await this.apiCall.get(this.base_url + url);
        return response.data;
    }

    async getUser() {
        var url = (this.token != null) ? '/api/user2' : '/sso/user';
        const response = await this.apiCall.get(this.base_url + url);
        return response.data;
    }
    
    async openWin() {
        var self = this;
        try {
            const y = window.top.outerHeight / 2 + window.top.screenY - ( 500 / 2);
            const x = window.top.outerWidth / 2 + window.top.screenX - ( 500 / 2);
            self.ssoWindow = window.open(this.base_url + "/sso/login", "ssoWindow", "width=500,height=500, top=${y}, left=${x}, menubar=no");
            return await new Promise(resolve => {
                const interval = setInterval(() => {
                    if(self.ssoWindow.closed) {
                        console.log('close window');
                        clearInterval(interval);
                        resolve(true);
                    }
                }, 1000);
              });

        } catch (error) {
            console.error(error);
            return false;
        }
    }

    async login(_callBack) {
        var self = this;
        const isLogin = await self.isLogin();
        if (isLogin['status']) {
            this.loading();
            const user = await self.getUser();
            _callBack(user);
        }
        else {
            _callBack(isLogin);
        }
    }

    async loginWindow(_callBack) {
        var self = this;
        const status = await self.openWin();
        console.log('status ' + status);
        if (status) {
            const isLogin = await self.isLogin();
            if (isLogin['status']) {
                this.loading();
                const user = await self.getUser();
                _callBack(user);
            }
            else {
                console.log('Gagal login 1.....');
            }
        }
        else {
            console.log('Gagal Login 2.....');
        }
    }
}