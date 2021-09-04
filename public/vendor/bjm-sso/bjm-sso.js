class BjmSSO {
            
    constructor() {
        this.base_url = 'http://sso.banjarmasinkota.go.id';
        // this.base_url = 'http://sso.banjarmasinkota.test:8000';

        this.apiCall = axios.create({
            headers: {
                "Content-type": "application/json",
                "Access-Control-Allow-Origin": "*",
            },
            withCredentials: true
        })
    }

    async isLogin() {
        const response = await this.apiCall.get(this.base_url + '/sso/is-login');
        return response.data;
    }

    async getUser() {
        const response = await this.apiCall.get(this.base_url + '/sso/user');
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
                        resolve(true);
                        console.log('close window');
                        clearInterval(interval);
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