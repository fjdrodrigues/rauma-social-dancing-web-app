import { User } from './user.model'

export class Post {
	id: number;
	title: string;
	text?: string;
	category?: string;
	author: User;
	creationDate: Date;
}