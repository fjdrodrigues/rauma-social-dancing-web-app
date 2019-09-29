import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from  'rxjs';
import { Post } from '../domain/post.model';


@Injectable({
	providedIn: 'root'
})
export class PostService {
	constructor(private httpClient: HttpClient) { }

	baseUrl = 'http://amordkizomba.c1.biz/api';
	posts: Post[];

	createPost(post: Post): Observable<Post> {
		return this.httpClient.post<Post>(`${this.baseUrl}/posts.php`, post); //,
		// catchError(this.handleError);
	}

	getPost(post_id: number): Observable<Post> {
		return this.httpClient.get<Post>(`${this.baseUrl}/posts.php?id=${post_id}`); //,
		// catchError(this.handleError);
	}
	
	getAllFromCategory(category: string): Observable<Post[]> {
		return this.httpClient.get<Post[]>(`${this.baseUrl}/posts.php?category=${category}`); //,
		// catchError(this.handleError);
	}

	getAll(): Observable<Post[]> {
		return this.httpClient.get<Post[]>(`${this.baseUrl}/posts.php`); //,
		// catchError(this.handleError);
	}

	editPost(post: Post) {
		return this.httpClient.put<Post>(`${this.baseUrl}/posts.php`, post); //,
		// catchError(this.handleError);
	}

	deletePost(post_id: number) {
		return this.httpClient.delete<Post>(`${this.baseUrl}/posts.php/?id=${post_id}`); //,
		// catchError(this.handleError);
	}
}
