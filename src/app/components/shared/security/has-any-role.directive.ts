import { Directive, Input, TemplateRef, ViewContainerRef } from '@angular/core';
import { TokenStorageService } from './token-storage.service';

/**
 * @whatItDoes Conditionally includes an HTML element if current user has any
 * of the authorities passed as the `expression`.
 *
 * @howToUse
 * ```
 *     <some-element *adkHasAnyRole="'admin'">...</some-element>
 *
 *     <some-element *adkHasAnyRole="['admin', 'user']">...</some-element>
 * ```
 */
@Directive({
    selector: '[adkHasAnyRole]'
})
export class HasAnyRoleDirective {

    private roles: string[];

    constructor(private tokenStorageService: TokenStorageService, private templateRef: TemplateRef<any>, private viewContainerRef: ViewContainerRef) {
    }

    @Input()
    set adkHasAnyRole(value: string|string[]) {
        this.roles = typeof value === 'string' ? [ <string> value ] : <string[]> value;
        this.updateView();
        // Get notified each time authentication state changes.
        this.tokenStorageService.getAuthenticationState().subscribe((user) => this.updateView());
    }

    private updateView(): void {
        this.viewContainerRef.clear();
        if ( this.tokenStorageService.hasAnyRole(this.roles)) {
            this.viewContainerRef.createEmbeddedView(this.templateRef);
        }
    }
}