export enum UserType {
	admin = 'admin',
	user = 'user'
}

export interface User {
	id: number;
	username: string;
	password?: string;
	firstName: string;
	lastName: string;
	birthDate: Date;
	userType: UserType;
}
