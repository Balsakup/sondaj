import TestComponent from './components/TestComponent';
import PageComponent from './components/PageComponent';

export default [
    { path: '/', component: TestComponent },
    { path: '/page/:num', component: PageComponent }
];
