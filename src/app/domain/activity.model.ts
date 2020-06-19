import { User } from './user.model'

export class Activity {
	id: number;
	title: string;
	description?: string;
	category?: string;
	location?: string;
	startDate?: Date;
	endDate?: Date;
	duration?: number;
	author: User;
	creationDate: Date;
}