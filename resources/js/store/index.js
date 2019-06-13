import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);


export default new Vuex.Store(
{
	state: {
		token:'',
	  // currentCiiu: '',
	  // changeState: false,
	  // establishment: '',
	  // naturalStates:'',
	  user: '',
	  // pdaOption: false,
	  // currentWizardStep: 0,
	  // wisardStepRights: [],
	  // source:'',
	  // burners:[],
	},
	mutations: {
		changeToken(state, token) {
		    state.token = token;
		},

		// changePda(state, option) {
		//     state.pdaOption = option;
		// },
		// changeCiiu(state, ciiu) {
		//     state.currentCiiu = ciiu;
		// },
		// changeStateCell(state,value){
		// 	state.changeState = value
		// },	
		// changeCurrentWizardStep(state, currentWizardStep) {
		//   	state.currentWizardStep = currentWizardStep;
		// },
		// changeWisardStepRights(state, wisardStepRights){
		// 	state.wisardStepRights = wisardStepRights;
		// },
		// changeEstablishment(state, establishment) {
		//   	state.establishment = establishment;
		//   	state.currentCiiu = establishment.ciiu4.name;
		// },
		changeUser(state, user) {
		   	state.user = user
		},
		// changeBurners(state, burners) {
		//   	state.burners = burners
		// },
		// changeSource(state, source) {
		//   	state.source = source
		// },
		// changeNaturalStates(state, naturalStates) {
		//   	state.naturalStates = naturalStates;
		// }
	},
	getters: {
		token: state => state.token,
		// currentCiiu: state => state.currentCiiu,
		// changeState: state => state.changeState,
		// pdaOption: state => state.pdaOption,
		// establishment: state => state.establishment,
		// company: state => state.establishment.company, 
		// commune: state => state.establishment.commune, 
		user: state => state.user,
		// currentWizardStep: state => state.currentWizardStep,
		// wisardStepRights: state => state.wisardStepRights,
		// naturalStates: state => state.naturalStates,
		// source: state => state.source,
		// burners: state => state.burners,
	}
});