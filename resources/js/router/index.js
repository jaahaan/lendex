import Vue from "vue";
import Router from "vue-router";
const User = window.authUser;
const companySetting = window.companySetting;
const companyTitle =  companySetting && companySetting.companyName ? companySetting.companyName : "Company Name";

// import my_account from "../pages/my-dashboard/my_account.vue";


import index from "../pages/index.vue";

/*************************************   Settings   ***************************************************************/
// Company Settings
import edit_settings from "../pages/setup/settings/company-settings/main-settings/edit_settings.vue";
import settings from "../pages/setup/settings/company-settings/main-settings/index.vue";
import theme_settings from "../pages/setup/settings/company-settings/theme_settings.vue";


// Routers
import add_router from '../pages/settings/routers/add_router';
import edit_router from '../pages/settings/routers/edit_router.vue';
import routers from '../pages/settings/routers/index.vue';

//service
import add_service_point from '../pages/service/add_service_point';
import add_service_title from '../pages/service/add_service_title';
import edit_service from '../pages/service/edit_service';
import service from '../pages/service/index';

//special-skills
import add_skill from '../pages/special-skills/add_skill';
import edit_skill from '../pages/special-skills/edit_skill';
import special_skills from '../pages/special-skills/index';
//project
import add_project from '../pages/projects/add_project';
import edit_project from '../pages/projects/edit_project';
import projects from '../pages/projects/index';

//education
import add_education from '../pages/education/add_education';
import edit_education from '../pages/education/edit_education';
import education from '../pages/education/index';
//experiences
import add_experience from '../pages/experiences/add_experience';
import edit_experience from '../pages/experiences/edit_experience';
import experience from '../pages/experiences/index';
//count
import add_count from '../pages/count/add_count';
import count from '../pages/count/index';
import update_count from '../pages/count/update_count';

//satisfied_clients
import add_satisfied_clients from '../pages/satisfied_clients/add_satisfied_clients';
import edit_satisfied_clients from '../pages/satisfied_clients/edit_satisfied_clients';
import satisfied_clients from '../pages/satisfied_clients/index';

//service_planning
import add_service_planning from '../pages/service_planning/add_service_planning';
import edit_service_planning from '../pages/service_planning/edit_service_planning';
import service_planning from '../pages/service_planning/index';

//trusted_company
import add_trusted_company from '../pages/trusted_company/add_trusted_company';
import edit_trusted_company from '../pages/trusted_company/edit_trusted_company';
import trusted_company from '../pages/trusted_company/index';

import contact_me from '../pages/contact_me/index';


let adminAndEditor = ["Admin", "Editor"];

Vue.use(Router);
export default new Router({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "index",
            component: index,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Dashboard - ${companyTitle}`,
                pageTitle: "Dashboard",
            },
        },
        
        // {
        //     path: "/my_account",
        //     name: "my_account",
        //     component: my_account,
        //     meta: {
        //         type: "notInMenu",
        //         parent: "index",
        //         title: `My Account - ${companyTitle}`,
        //         pageTitle: "My Account",
        //     },
        // },

        // Settings
        {
            path: "/settings",
            name: "settings",
            component: settings,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Company Settings - ${companyTitle}`,
                pageTitle: "Company Settings",
            },
        },
        {
            path: "/edit_settings",
            name: "edit_settings",
            component: edit_settings,
            meta: {
                type: "notInMenu",
                parent: "settings",
                title: `Edit Company Settings - ${companyTitle}`,
                pageTitle: "Edit Company Settings",
            },
        },

        {
            path: "/theme_settings",
            name: "theme_settings",
            component: theme_settings,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Theme settings - ${companyTitle}`,
                pageTitle: "Theme settings",
            },
        },
        
       
        // {
        //     path: "/menus",
        //     name: "menus",
        //     component: menus,
        //     meta: {
        //         type: "inMenu",
        //         parent: null,
        //         title: `Menus- ${companyTitle}`,
        //         pageTitle: "Menus",
        //     },
        // },

   

        
        {
            path: '/routers',
            name: 'routers',
            component: routers,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Routers - ${companyTitle}`,
                pageTitle: 'Routers',
            }
        },
        {
            path: '/add_router',
            name: 'add_router',
            component: add_router,
            meta: {
                type: "notInMenu",
                parent: "routers",
                title: `Add Router - ${companyTitle}`,
                pageTitle: 'Add Router',
            }
        },
        {
            path: '/edit_router/:id',
            name: 'edit_router',
            component: edit_router,
            meta: {
                type: "notInMenu",
                parent: "routers",
                title: `Edit Router - ${companyTitle}`,
                pageTitle: 'Edit Router',
            }
        },

        {
            path: '/service',
            name: 'service',
            component: service,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Service - ${companyTitle}`,
                pageTitle: 'service',
            }
        },
        {
            path: '/add_service_title',
            name: 'add_service_title',
            component: add_service_title,
            meta: {
                type: "notInMenu",
                parent: "service",
                title: `Add Service Title - ${companyTitle}`,
                pageTitle: 'Add Service Title',
            }
        },
        {
            path: '/add_service_point',
            name: 'add_service_point',
            component: add_service_point,
            meta: {
                type: "notInMenu",
                parent: "service",
                title: `Add Service Point - ${companyTitle}`,
                pageTitle: 'Add Service Point',
            }
        },
        {
            path: '/edit_service/:id',
            name: 'edit_service',
            component: edit_service,
            meta: {
                type: "notInMenu",
                parent: "service",
                title: `Edit Service Title - ${companyTitle}`,
                pageTitle: 'Edit Service Title',
            }
        },
        {
            path: '/special_skills',
            name: 'special_skills',
            component: special_skills,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Special Skills - ${companyTitle}`,
                pageTitle: 'Special Skills',
            }
        },
        {
            path: '/add_skill',
            name: 'add_skill',
            component: add_skill,
            meta: {
                type: "notInMenu",
                parent: "special_skills",
                title: `Add Skill - ${companyTitle}`,
                pageTitle: 'Add Skill',
            }
        },
        {
            path: '/edit_skill/:id',
            name: 'edit_skill',
            component: edit_skill,
            meta: {
                type: "notInMenu",
                parent: "special_skills",
                title: `Edit Skill - ${companyTitle}`,
                pageTitle: 'Edit Skill',
            }
        },

        {
            path: '/projects',
            name: 'projects',
            component: projects,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Projects - ${companyTitle}`,
                pageTitle: 'Projects',
            }
        },
        {
            path: '/add_project',
            name: 'add_project',
            component: add_project,
            meta: {
                type: "notInMenu",
                parent: "projects",
                title: `Add Project - ${companyTitle}`,
                pageTitle: 'Add Project',
            }
        },
        {
            path: '/edit_project/:id',
            name: 'edit_project',
            component: edit_project,
            meta: {
                type: "notInMenu",
                parent: "projects",
                title: `Edit Project - ${companyTitle}`,
                pageTitle: 'Edit Project',
            }
        },
        {
            path: '/education',
            name: 'education',
            component: education,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Education - ${companyTitle}`,
                pageTitle: 'Education',
            }
        },
        {
            path: '/add_education',
            name: 'add_education',
            component: add_education,
            meta: {
                type: "notInMenu",
                parent: "education",
                title: `Add Education - ${companyTitle}`,
                pageTitle: 'Add Education',
            }
        },
        {
            path: '/edit_education/:id',
            name: 'edit_education',
            component: edit_education,
            meta: {
                type: "notInMenu",
                parent: "education",
                title: `Edit Education - ${companyTitle}`,
                pageTitle: 'Edit Education',
            }
        },
        {
            path: '/experience',
            name: 'experience',
            component: experience,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Experience - ${companyTitle}`,
                pageTitle: 'Experience',
            }
        },
        {
            path: '/add_experience',
            name: 'add_experience',
            component: add_experience,
            meta: {
                type: "notInMenu",
                parent: "experience",
                title: `Add experience - ${companyTitle}`,
                pageTitle: 'Add Experience',
            }
        },
        {
            path: '/edit_experience/:id',
            name: 'edit_experience',
            component: edit_experience,
            meta: {
                type: "notInMenu",
                parent: "experience",
                title: `Edit Experience - ${companyTitle}`,
                pageTitle: 'Edit Experience',
            }
        },

        {
            path: '/count',
            name: 'count',
            component: count,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Count - ${companyTitle}`,
                pageTitle: 'Count',
            }
        },
        {
            path: '/add_count',
            name: 'add_count',
            component: add_count,
            meta: {
                type: "notInMenu",
                parent: "count",
                title: `Add count - ${companyTitle}`,
                pageTitle: 'Add count',
            }
        },
        {
            path: '/update_count',
            name: 'update_count',
            component: update_count,
            meta: {
                type: "notInMenu",
                parent: "count",
                title: `Edit count - ${companyTitle}`,
                pageTitle: 'Edit count',
            }
        },
        {
            path: '/satisfied_clients',
            name: 'satisfied_clients',
            component: satisfied_clients,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Satisfied Clients - ${companyTitle}`,
                pageTitle: 'Satisfied Clients',
            }
        },
        {
            path: '/add_satisfied_clients',
            name: 'add_satisfied_clients',
            component: add_satisfied_clients,
            meta: {
                type: "notInMenu",
                parent: "satisfied_clients",
                title: `Add satisfied_clients - ${companyTitle}`,
                pageTitle: 'Add satisfied_clients',
            }
        },
        {
            path: '/edit_satisfied_clients/:id',
            name: 'edit_satisfied_clients',
            component: edit_satisfied_clients,
            meta: {
                type: "notInMenu",
                parent: "satisfied_clients",
                title: `Edit satisfied_clients - ${companyTitle}`,
                pageTitle: 'Edit satisfied_clients',
            }
        },

        {
            path: '/service_planning',
            name: 'service_planning',
            component: service_planning,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Service planning - ${companyTitle}`,
                pageTitle: 'Service Planning',
            }
        },
        {
            path: '/add_service_planning',
            name: 'add_service_planning',
            component: add_service_planning,
            meta: {
                type: "notInMenu",
                parent: "service_planning",
                title: `Add service_planning - ${companyTitle}`,
                pageTitle: 'Add service_planning',
            }
        },
        {
            path: '/edit_service_planning/:id',
            name: 'edit_service_planning',
            component: edit_service_planning,
            meta: {
                type: "notInMenu",
                parent: "service_planning",
                title: `Edit service Planning - ${companyTitle}`,
                pageTitle: 'Edit service Planning',
            }
        },

        {
            path: '/contact_me',
            name: 'contact_me',
            component: contact_me,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Contact Me - ${companyTitle}`,
                pageTitle: 'Contact Me',
            }
        },

        {
            path: '/trusted_company',
            name: 'trusted_company',
            component: trusted_company,
            meta: {
                type: "inMenu",
                parent: null,
                title: `Trusted Company - ${companyTitle}`,
                pageTitle: 'Trusted Company',
            }
        },
        {
            path: '/add_trusted_company',
            name: 'add_trusted_company',
            component: add_trusted_company,
            meta: {
                type: "notInMenu",
                parent: "trusted_company",
                title: `Add trusted_company - ${companyTitle}`,
                pageTitle: 'Add Trusted Company',
            }
        },
        {
            path: '/edit_trusted_company/:id',
            name: 'edit_trusted_company',
            component: edit_trusted_company,
            meta: {
                type: "notInMenu",
                parent: "trusted_company",
                title: `Edit Trusted Company - ${companyTitle}`,
                pageTitle: 'Edit Trusted Company',
            }
        },

        
    ],
});
