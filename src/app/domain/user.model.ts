enum UserType {
	admin,
	user
}

export class User {
	id: number;
	username: string;
	firstName: string;
	lastName: string;
	birthdate: Date;
	userType: UserType;
	creationDate: Date;
}