import Rating from '@mui/material/Rating/index';
import apiFetch from '@wordpress/api-fetch';
import { render, useEffect, useState } from '@wordpress/element';

function RecipeRating(props) {

	const [avgRating, setAvgRating] = useState(props.avgRating);
	const [permission, setPermission] = useState(props.loggedIn);

	useEffect(() => {
		if (props.ratingCount) {
			setPermission(false);
		}
	}, []);
	return (
		<Rating
			value={avgRating}
			precision={0.5}
			onChange={async (event, rating) => {
				if (!permission) {
					return alert('You have already rated this recipe or you may need to log in.');
				}
				setPermission(false);

				const response = await apiFetch({
					path: 'up/v1/rate',
					method: 'POST',
					data: {
						postID: props.postID,
						rating
					}
				});

				if (response.status === 'success') {
					setAvgRating(response.rating);
				}
			}}
		/>
	);
}

document.addEventListener('DOMContentLoaded', () => {
	const block = document.querySelector('#recipe-rating');
	const postID = parseInt(block.dataset.postId);
	const avgRating = parseFloat(block.dataset.avgRating);
	const loggedIn = !!block.dataset.loggedIn;
	const ratingCount = !!parseInt(block.dataset.ratingCount);

	render(
		<RecipeRating
			postID={postID}
			avgRating={avgRating}
			loggedIn={loggedIn}
			ratingCount={ratingCount}
		/>,
		block
	);

});