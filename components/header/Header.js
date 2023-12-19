
class Header {
    domElement;
    constructor(headerDomElement) {
        if (!headerDomElement) {
            return;
        }
        this.domElement = headerDomElement;
        this.init();
    }

    init = () => {
    };
}

export { Header };
