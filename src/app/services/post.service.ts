import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from  'rxjs';
import { environment } from '../../environments/environment';
import { Post } from '../domain/post.model';



@Injectable({
	providedIn: 'root'
})
export class PostService {

	private baseUrl = environment.baseUrl;
	private posts: Post[];

	constructor(private httpClient: HttpClient) {

	}

	testPost(post_id: number): Observable<Post> {
		return this.httpClient.get<Post>(`${this.baseUrl}/post/${post_id}`);
		// catchError(this.handleError);
	}

	createPost(post: Post): Observable<Post> {
		return this.httpClient.post<Post>(`${this.baseUrl}/post.php`, post); //,
		// catchError(this.handleError);
	}

	getPost(post_id: number): Observable<Post> {
		return this.httpClient.get<Post>(`${this.baseUrl}/post.php?id=`); //,
		// catchError(this.handleError);
	}
	
	getAllFromCategory(category: string): Observable<Post[]> {
		return this.httpClient.get<Post[]>(`${this.baseUrl}/post.php?category=${category}`); //,
		// catchError(this.handleError);
	}

	getAll(): Observable<Post[]> {
		return this.httpClient.get<Post[]>(`${this.baseUrl}/post.php`); //,
		// catchError(this.handleError);
	}

	editPost(post: Post) {
		return this.httpClient.put<Post>(`${this.baseUrl}/post.php`, post); //,
		// catchError(this.handleError);
	}

	deletePost(post_id: number) {
		return this.httpClient.delete<Post>(`${this.baseUrl}/post.php/?id=${post_id}`); //,
		// catchError(this.handleError);
	}
}
