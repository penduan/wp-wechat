import { store, getContext } from '@wordpress/interactivity';

store('navigator__store', {
	actions: {
		onClick: () => {
			const { type = 'navigateTo', url } = getContext();
			if (type != 'navigateBack' && !url) {
				return;
			}
			if (!window.wx) {
				console.error('WeChat JS SDK not loaded');
				return;
			}

			wx.miniProgram[type]({ url })
		}
	},
});
