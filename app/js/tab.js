function TabOver(tab) {
	if (tab.className=='tab') tab.className='tab-over tab';
}

function TabOut(tab) {
	if (tab.className=='tab-over tab') tab.className='tab';
}