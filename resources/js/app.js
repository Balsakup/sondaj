import Vue from 'vue';
import VueRouter from 'vue-router';

import routes from './routes';

import SurveyComponent from './components/SurveyComponent';

String.prototype.hashCode = function () {
    let hash = 0;

    for (let i = 0; i < this.length; i++) {
        hash += Math.pow(this.charCodeAt(i) * 31, this.length - i);
        hash &= hash;
    }

    return hash;
};

if (document.getElementById('survey')) {
    const json = JSON.parse(document.querySelector('[data-survey-json]').textContent);
    const hash = json.toString().hashCode();

    if (localStorage.getItem('survey-hash') !== hash) {
        localStorage.setItem('survey-hash', hash);
        localStorage.setItem('survey-json', json);
    }

    Vue.use(VueRouter);

    const app = new Vue({
        el        : '#survey',
        template  : '<SurveyComponent :json="json.survey" />',
        components: { SurveyComponent },
        data      : { json },
        router    : new VueRouter({ routes })
    });
}
