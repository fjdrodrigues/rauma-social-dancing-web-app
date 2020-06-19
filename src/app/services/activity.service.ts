import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Observable, throwError } from  'rxjs';
import { catchError } from 'rxjs/operators';
import { environment } from '../../environments/environment';
import { Activity } from '../domain/activity.model';

@Injectable({
	providedIn: 'root'
})
export class ActivityService {

	private baseUrl = environment.baseUrl;
    
	constructor(private httpClient: HttpClient) {}

	get(activityID: number): Observable<Activity> {
        return this.httpClient.get<Activity>(`${this.baseUrl}/activity/${activityID}`)
            .pipe(catchError(this.handleError));
	}

	getAll(): Observable<Activity[]> {
		return this.httpClient.get<Activity[]>(`${this.baseUrl}/activity`)
        .pipe(catchError(this.handleError));
	}
	
	getAllFromCategory(category: string): Observable<Activity[]> {
		return this.httpClient.get<Activity[]>(`${this.baseUrl}/activity?category=${category}`)
        .pipe(catchError(this.handleError));
	}

	getAllPast(): Observable<Activity[]> {
		return this.httpClient.get<Activity[]>(`${this.baseUrl}/activity/past`)
        .pipe(catchError(this.handleError));
	}
	
	getAllPastFromCategory(category: string): Observable<Activity[]> {
		return this.httpClient.get<Activity[]>(`${this.baseUrl}/activity/past?category=${category}`)
        .pipe(catchError(this.handleError));
	}

	getAllCurrent(): Observable<Activity[]> {
		return this.httpClient.get<Activity[]>(`${this.baseUrl}/activity/current`)
        .pipe(catchError(this.handleError));
	}
	
	getAllCurrentFromCategory(category: string): Observable<Activity[]> {
		return this.httpClient.get<Activity[]>(`${this.baseUrl}/activity/current?category=${category}`)
        .pipe(catchError(this.handleError));
	}

	getAllFuture(): Observable<Activity[]> {
		return this.httpClient.get<Activity[]>(`${this.baseUrl}/activity/future`)
        .pipe(catchError(this.handleError));
	}
	
	getAllFutureFromCategory(category: string): Observable<Activity[]> {
		return this.httpClient.get<Activity[]>(`${this.baseUrl}/activity/future?category=${category}`)
        .pipe(catchError(this.handleError));
	}

	create(activity: Activity): Observable<Activity> {
		return this.httpClient.post<Activity>(`${this.baseUrl}/activity`, activity)
        .pipe(catchError(this.handleError));
	}

	update(activity: Activity): Observable<Activity> {
		return this.httpClient.put<Activity>(`${this.baseUrl}/activity`, activity)
        .pipe(catchError(this.handleError));
	}

	delete(activityID: number) {
		return this.httpClient.delete<Activity>(`${this.baseUrl}/activity/${activityID}`)
        .pipe(catchError(this.handleError));
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
