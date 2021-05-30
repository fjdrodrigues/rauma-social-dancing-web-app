import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Observable, throwError } from  'rxjs';
import { catchError } from 'rxjs/operators';
import { environment } from '../../environments/environment';
import { Tag } from '../domain/tag.interface';

@Injectable({
	providedIn: 'root'
})
export class TagService {

	private baseUrl = environment.baseUrl;
    
	constructor(private httpClient: HttpClient) {}

	get(tagID: number): Observable<Tag> {
        return this.httpClient.get<Tag>(`${this.baseUrl}/tag/${tagID}`);
	}

	getAll(): Observable<Tag[]> {
		return this.httpClient.get<Tag[]>(`${this.baseUrl}/tag`);
	}
	
	getAllActivityTags(): Observable<Tag[]> {
		return this.httpClient.get<Tag[]>(`${this.baseUrl}/tag`)
        .pipe(catchError(this.handleError));
	}

	getAllPast(): Observable<Tag[]> {
		return this.httpClient.get<Tag[]>(`${this.baseUrl}/tag/past`)
        .pipe(catchError(this.handleError));
	}
	
	getAllPastFromCategory(category: string): Observable<Tag[]> {
		return this.httpClient.get<Tag[]>(`${this.baseUrl}/tag/past?category=${category}`)
        .pipe(catchError(this.handleError));
	}

	getAllCurrent(): Observable<Tag[]> {
		return this.httpClient.get<Tag[]>(`${this.baseUrl}/tag/current`)
        .pipe(catchError(this.handleError));
	}
	
	getAllCurrentFromCategory(category: string): Observable<Tag[]> {
		return this.httpClient.get<Tag[]>(`${this.baseUrl}/tag/current?category=${category}`)
        .pipe(catchError(this.handleError));
	}

	getAllFuture(): Observable<Tag[]> {
		return this.httpClient.get<Tag[]>(`${this.baseUrl}/tag/future`)
        .pipe(catchError(this.handleError));
	}
	
	getAllFutureFromCategory(category: string): Observable<Tag[]> {
		return this.httpClient.get<Tag[]>(`${this.baseUrl}/tag/future?category=${category}`)
        .pipe(catchError(this.handleError));
	}

	create(tag: Tag): Observable<Tag> {
		return this.httpClient.post<Tag>(`${this.baseUrl}/tag`, tag);
	}

	update(tag: Tag): Observable<Tag> {
		return this.httpClient.put<Tag>(`${this.baseUrl}/tag`, tag);
	}

	delete(tagID: number) {
		return this.httpClient.delete<Tag>(`${this.baseUrl}/tag/${tagID}`);
    }
    
    // Handle API errors
    handleError(error: HttpErrorResponse) {
        if (error.error instanceof ErrorEvent) {
            // A client-side or network error occurred. Handle it accordingly.
            console.error('An error occurred:', error.error.message);
        } else {
            // The backend returned an unsuccessful response code.
            // The response body may contain clues as to what went wrong,
            console.error(
                `Backend returned code ${error.status}, ` +
                `body was: ${error.error}`);
        }
        // return an observable with a user-facing error message
        return throwError('Something bad happened; please try again later.');
    }
}
