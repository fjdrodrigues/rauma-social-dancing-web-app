import { Tag } from './tag.interface';
import { Video } from './video.interface';
import { Image } from './image.interface';

export interface Activity {
	id: number;
	title: string;
	description?: string;
	category?: string;
	location?: string;
	startDate?: Date;
	endDate?: Date;
	duration?: number;
	authorID: number;
	creationDate: Date;
	tags?: Tag[];
	images?: Image[];
	videos?: Video[];
}