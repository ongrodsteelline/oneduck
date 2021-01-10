import Page from './Page'

const path = location.pathname
//eslint-disable-next-line
const base = path.replace(/page\/[0-9\/]+/g, '')

export default {
    name: 'index',
    path: base,
    component: Page,
    children: [
        {
            name: 'page',
            path: 'page/:id/',
            component: Page
        }
    ]
}